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

#Make Wang test app
cd board/nuvoton/match/match2_test/drv
make 
cd ../user
make
cd uart4\&5
make

#Back to basedir
cd ../../../../../../

cd board/nuvoton/match/wiegand
make

cd ../../../../

#cp files to the overlay
cp -af board/nuvoton/match/match2_test/drv/test_drv.ko overlay/scripts
cp -af board/nuvoton/match/match2_test/user/test_app overlay/scripts
cp -af board/nuvoton/match/match2_test/user/uart4\&5/uart_test overlay/scripts
cp -af board/nuvoton/match/wiegand/wiegand-gpio.ko overlay/scripts

if [ -d $APP_PATH ]; then
	cp $APP_PATH/yaffs2utils/mkyaffs2 output/target/usr/bin/
	cp $APP_PATH/yaffs2utils/unyaffs2 output/target/usr/bin/
	cp $APP_PATH/yaffs2utils/unspare2 output/target/usr/bin/
fi
