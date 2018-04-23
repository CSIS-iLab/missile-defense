chmod 600 /tmp/missile_rsa
eval "$(ssh-agent -s)" # Start the ssh agent
ssh-add /tmp/missile_rsa
git remote add missile-defense git@git.wpengine.com:staging/missile.git # add remote for staging site
git fetch --unshallow # fetch all repo history or wpengine complain
git status # check git status
git checkout master # switch to master branch
git add wp-content/themes/missile-defense/*.css -f # force all compiled CSS files to be added
git commit -m "compiled assets" # commit the compiled CSS files
git push -f missile-defense master:master #deploy to staging site from master to master