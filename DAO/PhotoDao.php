<?php

interface PhotoDao
{
    public function savePhoto(Photo $photo);
    public function getUsersPhoto($user);
    public function removePhoto($id, $user);
    public function getAllPhoto($offset);
    public function RatePhoto($id);
    public function getRatePhoto($id);

}