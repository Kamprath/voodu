#! /usr/bin/env bash
if [ $# -eq 0 ]; then
    echo "Usage: ./release.sh <semantic version number>"
    exit 1
fi

yarn production
git add public
git commit -m "Release v$1"
git tag -a "v$1" -m "Release v$1"

git push origin master && git push origin master --tags
git push production master && git push production master --tags