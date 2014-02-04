<?php
     $videoPath = "sites/default/files/videos/original/1224.mp4"
$cmd = "/opt/apps/ffmpeg/ffmpeg -i /opt/apps/VideoLibraryD7/sites/default/files/videos/original/1224.mp4 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//";
if (preg_match('/Duration: ((\d+):(\d+):(\d+))/s', `$cmd`, $time)) {
   $total = ($time[2] * 3600) + ($time[3] * 60) + $time[4];
   $second = rand(1, ($total - 1));
}
exec($cmd, $output, $return_var);
print_r($return_var);

?>
