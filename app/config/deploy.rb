set :application, "santehmarkt"
set :domain,      "santehmarkt.by"
set :deploy_to,   "/home/santehma/santehmarkt"

set :app_path,    		"app"
set :web_path,          "web"

set :user, 				"santehma"

set :shared_children,   [app_path + "/logs", web_path + "/uploads", "vendor"]

set :repository,  		"git@github.com:varloc2000/shop.git"
set :scm,         		:git
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`
set :branch,            "master"
set :deploy_via,        :remote_cache

set :use_composer,      true
set :vendors_mode,      "update"
set :update_vendors,    true

set :assets_install,    true
set :cache_warmup,      true

ssh_options[:forward_agent] = true
default_run_options[:pty] = true

set :model_manager, 	"doctrine"
# Or: `propel`

set :use_sudo,      	false

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :keep_releases,  3

# Be more verbose by uncommenting the following line
logger.level = Logger::MAX_LEVEL