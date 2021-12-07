import os, sys

try:
	os.system('php -S localhost:8170')
finally:
	sys.stdout.write(': Shutting down PHP localhost\n')
