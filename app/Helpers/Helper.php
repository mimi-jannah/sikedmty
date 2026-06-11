<?php

function formatTanggal($date)
{
    return \Carbon\Carbon::parse($date)
        ->translatedFormat('d F Y');
}