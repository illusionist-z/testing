set HERE=%CD% 
set JAVA_HOME=%HERE%C:\Program Files\Java\jdk1.8.0_20 
set PATH=%JAVA_HOME%\jre\bin;%JAVA_HOME%\bin;%PATH% 
set SELENIUM_VERSION=2.47.1
start java -jar selenium-server-standalone-%SELENIUM_VERSION%.jar -role hub 
start java -jar selenium-server-standalone-%SELENIUM_VERSION%.jar -role wd -hub http:/IP:4444/grid/register -port 5556 -browser “browserName=internet explorer,version=8,platform=WINDOWS” -browser browserName=chrome,platform=WINDOWS 
start java -jar selenium-server-standalone-%SELENIUM_VERSION%.jar -role wd -hub http://IP:4444/grid/register -port 5556 -browser “browserName=firefox,platform=LINUX”
start java -jar selenium-server-standalone-2.47.1.jar -role node -hub http://localhost:4444/grid/register -port 5557