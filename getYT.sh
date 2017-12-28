#!/bin/bash

if [ $# -lt 1 ]
then
  exit 1
fi

id="$(wget -qO- "https://www.youtube.com/watch?v=ZKVn_Cn6kVY&list=$1"|grep 'yt-uix-scroller-scroll-unit'|sed 's/http/\nhttp/g'|grep '^https'|cut -d\/ -f5|sort -R|head -n1)"
youtube-dl -gf 171 "https://www.youtube.com/watch?v=$id"
