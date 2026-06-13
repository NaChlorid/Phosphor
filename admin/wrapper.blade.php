<?php
$bgFile = base_path('storage/app/phosphor_bg.txt');
$bgImage = (file_exists($bgFile) && trim(file_get_contents($bgFile)) !== '')
    ? trim(file_get_contents($bgFile))
    : '/extensions/phosphor/default-phosphor.png';
?>
<style>
    :root {
        --theme-bg-image: url('{{ $bgImage }}');
    }

</style>

