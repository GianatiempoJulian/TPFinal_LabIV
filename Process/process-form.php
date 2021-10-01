<?php

    ///procesa los datos y los pone en el JSON.
    require_once("Config/Autoload.php");

    use Repository\SongRepository as SongRepository;
    use Model\Song as Song;

    $songRepository_ = new SongRepository();
    $listsong = $songRepository_->getAll();

    if($_POST){

    
        $id = $_POST["id_song"];
        $name = $_POST["name_song"];

        $flag = 0;

        foreach($listsong as $song)
        {
            if(strcmp($name,$song->getName())==0)
            {
                $flag=1;
            }
        }

        if ($flag==1)
        {
            header("location:add-form.php?msg=dni_not_available");
        }

        else
        {
        $artist = $_POST["artist_song"];
        $year = $_POST["year_song"];
        

        $song = new Song();

        $song->setSongId($id);
        $song->setName($name);
        $song->setArtistId($artist);
        $song->setYear($year);
       

        $songRepository = new SongRepository();

        $songRepository->Add($song);
        
        header("location:nav.php");
        }
       
        
    }

   
    

?>