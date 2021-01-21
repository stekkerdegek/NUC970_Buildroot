#!/bin/sh

#sshfs root@192.168.178.137:/ ~/mounts/match m44s
#cd /Users/pjeutr/Mounts/match/
cd /maasland_app/
# rm -rf www/


git init .
git remote add -f origin https://github.com/pjeutr/MatchApp.git 
#git remote set-head origin -a
git checkout -f main

