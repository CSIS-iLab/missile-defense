chmod 600 /tmp/missilethreat_rsa
eval "$(ssh-agent -s)" # Start the ssh agent
ssh-add /tmp/missile_rsa
git remote add missilethreat-development git@git.wpengine.com:production/csismtdev.git # add remote for development site
git fetch --unshallow # fetch all repo history or wpengine complain
git status # check git status
git checkout development # switch to development branch
git add wp-content/themes/missilethreat/*.css -f # force all compiled CSS files to be added
git add wp-content/themes/missilethreat/assets -f # force all compiled JS & optimized images
git commit -m "Compiled & bundled all assets" # commit the compiled CSS files
git push -f missilethreat-development development #deploy to development site from development