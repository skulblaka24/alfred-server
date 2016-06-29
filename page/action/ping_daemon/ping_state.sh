#!/bin/bash

# Pour ne rien renvoyer &> /dev/null

# INIT 

out="0"
#cd /root/Desktop/ # MOD #
cd /Users/Gauth/Ressources/Projet_Jarvis\[2015\]/\[WEB\]\ Alfred\ Server/Alfred\ 2.0/page/action/
if [ ! -d ./ping_daemon/ ]; then
	mkdir ./ping_daemon
	cd ./ping_daemon/
elif [ -d ./ping_daemon/ ]; then
	cd ./ping_daemon/
fi



while [ $out = "0" ]; do
	count=($(wc -l < ./.input.txt))
	#count="4" # DEBUG #
	for (( i = 1; i < ($count+1); i++ )); 
		do
			address=( $( sed -n -e "$i"p ./.input.txt ) )
			cmdping=( $( ping -c 4 -q $address | grep time | awk  {'print $4'} ) )
			#echo "count = "$count # DEBUG #
			
			
			if [ -z $cmdping ]; then
				cmdping="0"
			fi

			#echo "ping = "$cmdping # DEBUG #

			if [ "$cmdping" -eq "4" ]; then
				state="1"
			elif [ "$cmdping" -eq "3" ]; then
				state="1"
			else
				state="1"
			fi
		
			output=$state
			echo $output >> ./.ping_state

			#echo "address = "$address # DEBUG #
			#echo "output = "$output # DEBUG #
	done
	mv ./.ping_state ../../.etat_servers.txt # MOD #
	unset address
	unset cmdping
	unset state
	unset i
	unset count
	unset output
	sleep 120
done
