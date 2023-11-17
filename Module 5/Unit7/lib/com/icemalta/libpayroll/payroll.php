<?php
namespace com\icemalta\libpayroll;

interface StaffMember
{
    public function getPerksString(): string;
    public function getHealthBenefitsString(): string;
}

trait PayslipMetaData
{
    public const CURRENCY = '€';

    public function getPayslipDetails(): array
    {
        return [
            'currency' => self::CURRENCY,
            'content' => $this->getPaySlip()
        ];
    }
}

abstract class Worker
{
    use PayslipMetaData;

    private string $name = "";
    private string $surname = "";

    public function __construct(string $name, string $surname)
    {
        $this->name = $name;
        $this->surname = $surname;
    }

    abstract public function getRoleDescription(): string;

    /**
     * @return string the worker's name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name the worker's new name
     * @return self the modified worker object
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string the worker's surname
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname the worker's new surname
     * @return self the modified worker object
     */
    public function setSurname(string $surname): self
    {
        $this->surname = $surname;
        return $this;
    }
}

class Manager extends Worker implements StaffMember
{
    public function getPaySlip(): string
    {
        return "This is the payslip for the manager.";
    }

    public function getRoleDescription(): string
    {
        return 'This is a manager';
    }

    public function getPerksString(): string
    {
        return "Retirement contribution, 24/7 Gym, Meals, Business-Class Travel";
    }

    public function getHealthBenefitsString(): string
    {
        return "Full private hospital, dental, cosmetic";
    }
}

class Employee extends Worker implements StaffMember
{
    public function getPaySlip(): string
    {
        return "This is the payslip for the Employee.";
    }

    public function getRoleDescription(): string
    {
        return 'This is an Employee';
    }

    public function getPerksString(): string
    {
        return "Retirement contribution, 24/7 Gym, Meals";
    }

    public function getHealthBenefitsString(): string
    {
        return "Full private hospital, dental";
    }
}

class Contractor extends Worker
{
    public function getPaySlip(): string
    {
        return "This is the payslip for the contractor.";
    }

    public function getRoleDescription(): string
    {
        return 'This is a Contractor';
    }
}