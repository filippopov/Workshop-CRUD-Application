<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 12.3.2017 г.
 * Time: 15:48
 */

namespace Service\User;


use Adapter\DatabaseInterface;
use Adapter\PDODatabase;
use Data\Cities\City;
use Data\Countries\Country;
use Data\Genders\Gender;
use Data\Orientations\Orientation;
use Data\User\User;
use Data\User\UserRegisterViewData;
use Exception\RegisterException;
use Service\Encryption\BCryptEncryptionService;
use Service\Encryption\EncryptionServiceInterface;

class UserService implements UserServiceInterface
{
    const MIN_AGE_ALLOWED = 18;

    /** @var  DatabaseInterface */
    private $db;

    /** @var  EncryptionServiceInterface */
    private $encryptionService;

    public function __construct(DatabaseInterface $db, EncryptionServiceInterface $encryptionService)
    {
        $this->db = $db;
        $this->encryptionService = $encryptionService;
    }

    public function register(string $firstName,
                             string $lastName,
                             string $nickname,
                             string $email,
                             string $password,
                             string $confirmPassword,
                             string $phone,
                             \DateTime $birthday,
                             int $genderId,
                             int $sexualOrientation,
                             int $countryId,
                             int $cityId,
                             string $description = null,
                             string $pictureUrl = null)
    {
        if ($password != $confirmPassword) {
            throw new RegisterException('Password mismatch');
        }

        $passwordHash = $this->encryptionService->encrypt($password);

        $interval = $birthday->diff(new \DateTime('now'));

        if ($interval->y < self::MIN_AGE_ALLOWED) {
            throw new RegisterException('Underage is not allowed');
        }

        $query = "INSERT INTO people (
                       first_name,
                       last_name,
                       nickname,
                       email,
                       phone,
                       password,
                       gender_id,
                       born_on,
                       sexual_orientation_id,
                       country_id,
                       city_id,
                       description,
                       picture
                    ) VALUES (
                       ?,
                       ?,
                       ?,
                       ?,
                       ?,
                       ?,
                       ?,
                       ?,
                       ?,
                       ?,
                       ?,
                       ?,
                       ?
                    );";


        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $firstName,
            $lastName,
            $nickname,
            $email,
            $phone,
            $passwordHash,
            $genderId,
            $birthday->format('Y-m-d'),
            $sexualOrientation,
            $countryId,
            $cityId,
            $description,
            $pictureUrl
        ]);
    }


    public function getRegisterViewData(): UserRegisterViewData
    {
        $userRegisterViewData = new UserRegisterViewData();

        $stmt = $this->db->prepare("SELECT id, name FROM genders ORDER BY name");
        $stmt->execute();
        $userRegisterViewData->setGenders(
            function () use ($stmt) {
                while ($gender = $stmt->fetchObject(Gender::class)) {
                    yield $gender;
                }
            }
        );

        $stmt = $this->db->prepare("SELECT id, name FROM cities ORDER BY name");
        $stmt->execute();
        $userRegisterViewData->setCities(
            function () use ($stmt) {
                while ($city = $stmt->fetchObject(City::class)) {
                    yield $city;
                }
            }
        );

        $stmt = $this->db->prepare("SELECT id, name FROM countries ORDER BY name");
        $stmt->execute();
        $userRegisterViewData->setCountries(
            function () use ($stmt) {
                while ($country = $stmt->fetchObject(Country::class)) {
                    yield $country;
                }
            }
        );

        $stmt = $this->db->prepare("SELECT id, name FROM sexual_orientations ORDER BY id");
        $stmt->execute();
        $userRegisterViewData->setOrientations(
            function () use($stmt) {
                while ($orientation = $stmt->fetchObject(Orientation::class)) {
                    yield $orientation;
                }
            }
        );

        return $userRegisterViewData;
    }

    public function login($username, $password) : bool
    {
        $query = "
            SELECT 
                id,
                password
            FROM
                people
            WHERE 
                nickname = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $username
        ]);

        /** @var User $user */
        $user = $stmt->fetchObject(User::class);

        if (! $user) {
            return false;
        }
        $passwordHash = $user->getPassword();

        if ($this->encryptionService->isValid($password, $passwordHash)) {
            $_SESSION['user_id'] = $user->getId();
            return true;
        }
        return false;
    }

    public function findOne($id) : User
    {
        $query =  "SELECT
                   people.id,
                   people.first_name AS firstName,
                   people.last_name AS lastName,
                   people.nickname,
                   people.phone,
                   people.email,
                   people.born_on AS bornOn,
                   genders.name AS gender,
                   sexual_orientations.name AS orientation,
                   countries.name AS country,
                   cities.name AS city,
                   picture,
                   description
                FROM
                   people
                INNER JOIN
                   genders
                ON
                   people.gender_id = genders.id
                INNER JOIN
                   sexual_orientations
                ON
                   people.sexual_orientation_id = sexual_orientations.id
                INNER JOIN
                   countries
                ON
                   people.country_id = countries.id
                INNER JOIN
                   cities
                ON
                   people.city_id = cities.id
                WHERE
                   people.id = ?";


        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);

        /** @var User $user */
        $user = $stmt->fetchObject(User::class);

        if (!$user->getPicture()) {
            $user->setPicture(dirname($_SERVER['PHP_SELF']) . '/avatars/no-avatar.png');
        }

        return $user;
    }
}