<?php

require_once dirname(__FILE__)."/BaseDao.class.php";

class UserDao extends BaseDao
{
    protected $table="users";

    public function get_customer_by_id($id)
    {
        return $this->query_unique("SELECT * FROM users, WHERE id=:id", ["id"=>$id]);
    }

    public function get_customer_by_email($email)
    {
        return $this->query_unique("SELECT * FROM users, WHERE email=:email", ["email"=>$email]);
    }

    public function get_all_users()
    {
        return $this->query("SELECT * FROM users", []);
    }


    public function add_users($entity)
    {
        return $this->insert($this->table, $entity);
    }

    public function update_customer($id, $customer)
    {
        $this->update("users", $id, $customer, "id");
    }

    public function update_users_by_email($email, $customer)
    {
        $this->update("users", $email, $customer, "email");
    }

    public function get_users($search, $offset, $limit, $order = "-id")
    {
        list($order_column, $order_direction) = self::parse_order($order);

        return $this->query("SELECT *
                       FROM users
                       WHERE LOWER(name) LIKE CONCAT('%', :name, '%')

                       LIMIT ${limit} OFFSET ${offset} ", ["name" => strtolower($search)]);
    }
}
