<?php

        $checkifi_in_table_scince = mysqli_query($conn, 
        "
        SELECT 
    genre.name,
    COALESCE(COUNT(CASE WHEN books.genre IS NOT NULL THEN books.genre END), 0) AS total_amount
FROM 
    genre
LEFT JOIN 
    books
ON 
    genre.name = books.genre
 WHERE genre.name = 'Science'
GROUP BY 
    genre.name;

        ");


        while ($booksVALUES = mysqli_fetch_assoc($checkifi_in_table_scince)) {
           
                ?><input type="hidden" id="scienceVALUES" value="<?= $booksVALUES['total_amount']?>"><?php
            
        }


      
       $checkifi_in_table_fantasy= mysqli_query($conn, 
        "
        SELECT 
    genre.name,
    COALESCE(COUNT(CASE WHEN books.genre IS NOT NULL THEN books.genre END), 0) AS total_amount
FROM 
    genre
LEFT JOIN 
    books
ON 
    genre.name = books.genre
 WHERE genre.name = 'Fantasy'
GROUP BY 
    genre.name;

        ");


        while ($booksVALUESfantasy = mysqli_fetch_assoc($checkifi_in_table_fantasy)) {
           
                ?><input type="hidden" id="fantasyVALUES" value="<?= $booksVALUESfantasy['total_amount']?>"><?php
            
        }  


         $checkifi_in_table_narrative= mysqli_query($conn, 
        "
        SELECT 
    genre.name,
    COALESCE(COUNT(CASE WHEN books.genre IS NOT NULL THEN books.genre END), 0) AS total_amount
FROM 
    genre
LEFT JOIN 
    books
ON 
    genre.name = books.genre
 WHERE genre.name = 'Narrative'
GROUP BY 
    genre.name;

        ");


        while ($booksVALUESnarrative = mysqli_fetch_assoc($checkifi_in_table_narrative)) {
           
                ?><input type="hidden" id="narrativeVALUES" value="<?= $booksVALUESnarrative['total_amount']?>"><?php
            
        }  


          $checkifi_in_table_novel= mysqli_query($conn, 
        "
        SELECT 
    genre.name,
    COALESCE(COUNT(CASE WHEN books.genre IS NOT NULL THEN books.genre END), 0) AS total_amount
FROM 
    genre
LEFT JOIN 
    books
ON 
    genre.name = books.genre
 WHERE genre.name = 'Novel'
GROUP BY 
    genre.name;

        ");


        while ($booksVALUESnovel = mysqli_fetch_assoc($checkifi_in_table_novel)) {
           
                ?><input type="hidden" id="novelVALUES" value="<?= $booksVALUESnovel['total_amount']?>"><?php
            
        }  


          $checkifi_in_table_mystery= mysqli_query($conn, 
        "
        SELECT 
    genre.name,
    COALESCE(COUNT(CASE WHEN books.genre IS NOT NULL THEN books.genre END), 0) AS total_amount
FROM 
    genre
LEFT JOIN 
    books
ON 
    genre.name = books.genre
 WHERE genre.name = 'Mystery'
GROUP BY 
    genre.name;

        ");


        while ($booksVALUESmystery = mysqli_fetch_assoc($checkifi_in_table_mystery)) {
           
                ?><input type="hidden" id="mysteryVALUES" value="<?= $booksVALUESmystery['total_amount']?>"><?php
            
        }  


         $checkifi_in_table_fictional = mysqli_query($conn, 
        "
        SELECT 
    genre.name,
    COALESCE(COUNT(CASE WHEN books.genre IS NOT NULL THEN books.genre END), 0) AS total_amount
FROM 
    genre
LEFT JOIN 
    books
ON 
    genre.name = books.genre
 WHERE genre.name = 'Fictional'
GROUP BY 
    genre.name;

        ");


        while ($booksVALUESfictional = mysqli_fetch_assoc($checkifi_in_table_fictional)) {
           
                ?><input type="hidden" id="fictionalVALUES" value="<?= $booksVALUESfictional['total_amount']?>"><?php
            
        } 

          $checkifi_in_table_history = mysqli_query($conn, 
        "
        SELECT 
    genre.name,
    COALESCE(COUNT(CASE WHEN books.genre IS NOT NULL THEN books.genre END), 0) AS total_amount
FROM 
    genre
LEFT JOIN 
    books
ON 
    genre.name = books.genre
 WHERE genre.name = 'History'
GROUP BY 
    genre.name;

        ");


        while ($booksVALUEShistory = mysqli_fetch_assoc($checkifi_in_table_history)) {
           
                ?><input type="hidden" id="historyVALUES" value="<?= $booksVALUEShistory['total_amount']?>"><?php
            
        } 
        
?>
