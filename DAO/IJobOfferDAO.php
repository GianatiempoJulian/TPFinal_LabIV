<?php

    namespace DAO;

    use Models\JobOffer as JobOffer;

    interface IJobPositionDAO{
        function Add(JobOffer $jobOffer);
        function getAll();
       
    }

?>