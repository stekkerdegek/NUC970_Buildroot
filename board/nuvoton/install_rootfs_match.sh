#!/bin/sh

#TOD replace cd with
BOARD_DIR="$(dirname $0)"
BOARD_NAME="$(basename ${BOARD_DIR})"
# ${BOARD_DIR}/matcht2_test/drv/make

#Make Wang test app
cd board/nuvoton/match/match2_test/drv
make 
cd ../user
make
cd uart4\&5
make

#Back to basedir
cd ../../../../../../

#cd board/nuvoton/match/simpleWiegandReader
cd board/nuvoton/match/wiegand-driver
make

cd ../../../../

#cp files to the overlay
cp -af board/nuvoton/match/match2_test/drv/test_drv.ko overlay/scripts
cp -af board/nuvoton/match/match2_test/user/test_app overlay/scripts
cp -af board/nuvoton/match/match2_test/user/uart4\&5/uart_test overlay/scripts
cp -af board/nuvoton/match/wiegand-driver/wiegand-driver.ko overlay/scripts

#if [ -d $APP_PATH ]; then
#	cp $APP_PATH/yaffs2utils/mkyaffs2 output/target/usr/bin/
#	cp $APP_PATH/yaffs2utils/unyaffs2 output/target/usr/bin/
#	cp $APP_PATH/yaffs2utils/unspare2 output/target/usr/bin/
#fi

#replace persistent config files by a symlink 
#rm output/target/etc/network/interfaces
#ln -s ../../maasland_app/etc/interfaces output/target/etc/network/interfaces
