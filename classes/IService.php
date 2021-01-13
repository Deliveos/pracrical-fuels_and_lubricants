<?php
interface IService {
  function save($obj);
  function delete($id);
  function findById($id);
  function findAll();
  function count();
}