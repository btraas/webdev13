FOLDER='/cygdrive/d/webdev13/G13/'
cd $FOLDER
`cp sync_in_progress.html index.html`

echo "pull.sh run" >itworked.txt
#exit

echo `git fetch`
echo `git reset --hard HEAD`
echo `git merge -s recursive -X theirs origin/master`
exit

#git pull

