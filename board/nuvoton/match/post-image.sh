#!/bin/sh

#mkyaffs2 --inband-tags maasland_app output/images/maasland_app.yaffs2

mkfs.ubifs -F -d maasland_app -e 0x1F000 -c 808 -m 0x800 -o output/images/maasland_app.ubifs
ubinize -o output/images/maasland_app.ubi -m 0x800 -p 0x20000 -s 2048 board/nuvoton/match/ubinize.cfg


