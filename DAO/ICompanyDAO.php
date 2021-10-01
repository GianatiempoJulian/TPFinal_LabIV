<?php

    namespace DAO;

    use Models\Company as Company;

    interface ICompanyDAO{
        function Add(Company $company);
        function getAll();
        function Remove($comp_id);
    }

?>