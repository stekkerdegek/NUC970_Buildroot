#!/bin/sh
APP_PATH=output/build/applications-1.0.0

 # cd board/nuvoton/rootfs-chili/usr/local/sbin/www/
 # make
 # cd /home/pjeutr/NUC970_Buildroot 

#cd overlay/var/www/chili/
#make -o cgi-bin
#cd /home/pjeutr/NUC970_Buildroot

#rm output/target/etc/resolv.conf
#cp -af board/nuvoton/rootfs-chili/* output/target/

cd board/nuvoton/match/match2_test/drv
make 
cd board/nuvoton/match/match2_test/user
make
cd board/nuvoton/match/match2_test/user/uart4&5
make

if [ -d $APP_PATH ]; then
	cp $APP_PATH/yaffs2utils/mkyaffs2 output/target/usr/bin/
	cp $APP_PATH/yaffs2utils/unyaffs2 output/target/usr/bin/
	cp $APP_PATH/yaffs2utils/unspare2 output/target/usr/bin/
fi
