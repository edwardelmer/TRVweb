Cleaned up the code in fsbuildparse.php so it works better

This is an updated version of Nabeel's code for navdata update which is avaliable by search in forums

-All intersections uploaded with a lat/lng
-All VOR / NDB correctly labeled
-Intersections all go in instead of hanging up


Works with fsbuild airac


Loading airways segments...91220 airway segments loaded...
Loading VORs...965 VORs added, 2834 updated
Loading NDBs...2202 NDBs added, 1800 updated
Loading INTs...65860 INTs added, 42994 updated
Completed!

-Would recommend backing up navdata table in database before running

-Program deletes all previous data in phpvms_navdata table before updating

-Also program will not work if the table phpvms_navdata is not present. If it isnt go to DBadmin and copy structure only from navdata table to phpvms_navdata

-Inserts into phpvms_navdata table. If prefix is different rename phpvms_navdata to navdata for example when complete

-Use at your own risk. Works great with me but can't say it will with everyone.

How to load NAVDATA for phpVMS
-------------

1. Unzip navdata.zip

2. Obtain fsbuild airac

3. Install fsbuild airac into same folder as fsbuild.exe(airac file)

3. need to have four files

awys.txt -airways (default fsbuild)
ints.txt - intersections (default fsbuild)
navs.txt - ndb/vor (default fsbuild - code fixed to label each separately)

5. Take the 3 files listed above insert them into navdata/fsbuild folder

6. Open db.php file and insert your DB username, password, & server name into the appropraiate places between ''

7. Upload navdata folder into root directory of site

8. Connect to server with ssh app. I use putty

9. cd to navdata

10. run php -f fsbuildparse.php at prompt

11. Takes maybe 5 mins or so then should get

Loading airways segments...91220 airway segments loaded...
Loading VORs...965 VORs added, 2834 updated
Loading NDBs...2202 NDBs added, 1800 updated
Loading INTs...65860 INTs added, 42994 updated
Completed!

12. Last thing would recommend sorting out NAV INTS in ints.txt and any intersection that is not 5 characters in length