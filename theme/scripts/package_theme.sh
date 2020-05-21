#!/bin/bash

##########################################
# Build Wordpress Theme
#
# Author: Emily Roth
# Website: emroth.com
# Github: https://github.com/errskipower/ 
#
##########################################

zip -r kneadylola-emroth.zip ./theme -x '*.git*' '*node_modules*' '*sass*' '*.DS_Store*' '*package*.json*' '*phpcs*' '*.eslintrc*' '*.stylelintrc.json*'