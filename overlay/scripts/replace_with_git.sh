#!/bin/sh
#
# Replace MatchApp with the latest version from github
#
#sshfs root@maasland:/ ~/mounts/match 
#cd /Users/pjeutr/Mounts/match/

cd maasland_app/
# rm -rf www/

git init .
git remote add -f origin https://github.com/pjeutr/MatchApp.git 
#git remote set-head origin -a
git checkout -f main

