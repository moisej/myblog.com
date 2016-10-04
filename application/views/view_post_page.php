<?php

echo '
            <div id="content">
';

foreach($data as $row)
{
    echo ' 
                <div class="panel panel-default">
                    <div class="panel-body"> ';

    if(!empty($row['image']))
    {
        echo '
                        <img id="post_image" src="data:image/jpeg;base64,'.$row['image'].'">';
    }
    echo '
                        <div id="post_location_text">
                            <h3>
                                <a href=/post/display/'.$row['id'].'>
                                    <div id="post_title">
                                        '. $row['title'] .'
                                    </div>
                                </a>
                            </h3>
                            <div id="post_text">'
                                . $row['text'] .
                           '</div>
                            <br>
                            <form method="POST" action="/Post/DownloadCsv/' . $row['id'] . '">
                                <input type="submit" value="Download CSV" class="btn btn-warning" />
                            </form>
                        </div>
                    </div>
                </div>
             </div>';
}
?>