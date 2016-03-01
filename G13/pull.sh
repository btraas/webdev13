cp 'sync_in_progress.html' 'index.html'

git fetch
git reset --hard HEAD
git merge -s recursive -X theirs origin/master
#git pull

