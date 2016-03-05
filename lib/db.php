<?php

class DB
{
    /**
     * @var PDO
     */
    private $conn;

    /**
     * @var DB
     */
    private static $instance;

    /**
     * @param string $username
     * @param string $password
     */
    public function __construct($database, $username, $password)
    {
        $this->conn = new PDO("mysql:dbname=$database", $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    }

    public static function register($database, $username, $password)
    {
        $instance = new self($database, $username, $password);
        self::$instance = $instance;
    }

    /**
     * @return DB
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            throw new RuntimeException("No database instance registered.");
        }

        return self::$instance;
    }

    /**
     * @param Company $company
     */
    public function saveCompany(Company $company)
    {
        $params = [
            "name" => $company->name,
        ];
        if ($company->id) {
            // Execute update.
            $stmt = $this->conn->prepare("UPDATE company SET name = :name WHERE id = :id LIMIT 1");
            $params["id"] = $company->id;
        } else {
            // Execute insert.
            $stmt = $this->conn->prepare("INSERT INTO company (name) VALUES (:name)");
        }
        $stmt->execute($params);
        if (!$company->id) {
            // This was an insert.
            $company->id = (int)$this->conn->lastInsertId();
        }
    }

    /**
     * @param int $id
     *
     * @return Company|null
     */
    public function findCompany($id)
    {
        $stmt = $this->conn->prepare("SELECT id, name FROM company WHERE id = :id LIMIT 1");
        $stmt->execute([
            "id" => $id,
        ]);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Company::class, [""]);

        return $stmt->fetch() ?: null;
    }

    /**
     * @return Company[]
     */
    public function getCompanies()
    {
        $stmt = $this->conn->prepare("SELECT id, name FROM company");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Company::class, [""]);

        return $stmt->fetchAll();
    }

    /**
     * @param Company $company
     */
    public function deleteCompany(Company $company)
    {
        $stmt = $this->conn->prepare("DELETE FROM company WHERE id = :id");
        $stmt->execute([
            "id" => $company->id,
        ]);
    }

    /**
     * @param string $statement
     */
    public function exec($statement)
    {
        $this->conn->exec($statement);
    }
}
