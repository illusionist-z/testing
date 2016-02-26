start /B ant launch-hub 
start /B ant -Denvironment=”*firefox” -Dport=5557  -DhubURL=http://localhost:4444 launch-remote-control