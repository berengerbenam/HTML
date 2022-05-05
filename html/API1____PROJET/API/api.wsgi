import sys
#sys.path.insert(0'/var/www/html/API')
sys.path.append('/var/www/html/API')
sys.stdout=sys.stderr
from api import app as application
