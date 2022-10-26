<?php


function getCurrentGitCommit(string $branch = 'master')
{
    if ($hash = file_get_contents(sprintf('.git/refs/heads/%s', $branch))) {
        return $hash;
    } else {
        return false;
    }
}

function printGitInfo(string $commit)
{
    $version = mb_substr($commit, 0, 5);

    echo "<footer class=\"fixed-bottom\">";
    echo "<span class=\"text-muted bg-white py-1 px-1\">v-$version</span>";
    echo "</footer>";
}
