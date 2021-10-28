<?php

    namespace DAO;

    use Models\Career as Career;

    interface ICareerDAO{
        function Add(Career $career);
        function getAll();
        function Remove($career_id);
    }

?>