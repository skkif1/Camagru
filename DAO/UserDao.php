<?php

interface UserDao
{
    public function getUserbyId($id);
    public function getUserByEmail($email);
    public function saveUser(User $user);
    public function updateUser(User $user);
}