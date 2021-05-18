#!/bin/sh

#/home/pjeutr/NUC970_Buildroot/output/host/usr/sbin/mkfs.jffs2 -e 0x20000 -l -d /home/pjeutr/NUC970_Buildroot/output/target -o /home/pjeutr/NUC970_Buildroot/output/images/rootfs.jffs2

#mkfs.jffs2 -e 0x20000 -l -d overlay/var/www -o output/images/userfs.jffs2


#/home/pjeutr/NUC970_Buildroot/output/host/usr/bin/mkyaffs2 --inband-tags --all-root /home/pjeutr/NUC970_Buildroot/output/target /home/pjeutr/NUC970_Buildroot/output/images/rootfs.yaffs2

mkyaffs2 --inband-tags maasland_app output/images/maasland_app.yaffs2

mkfs.ubifs -d maasland_app -e 0x1f800 -c 2048 -m 0x800 -x lzo  -o output/images/maasland_app.ubifs
#/home/pjeutr/nuvoton/matchOnNuc/output/host/usr/sbin/mkfs.ubifs -d /home/pjeutr/nuvoton/matchOnNuc/output/target -e 0x1f800 -c 2048 -m 0x800 -x lzo  -o /home/pjeutr/nuvoton/matchOnNuc/output/images/rootfs.ubifs

#unyaffs2 --nuc970-ecclayout tempie/user.yaffs2 tempie
#mkyaffs2 -b nuc970-bch --nuc970-ecclayout --inband-tags overlay/var/www output/images/user.yaffs2
