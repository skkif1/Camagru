<?php

interface UserDao
{
    public function getUserbyId($id);
    public function saveUser(User $user);
}