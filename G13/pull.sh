FOLDER='/cygdrive/d/webdev13/G13/'
cd $FOLDER
cp sync_in_progress.html index.html

echo "pull.sh run" >itworked.txt
exit

git fetch
git reset --hard HEAD
git merge -s recursive -X theirs origin/master
#git pull

