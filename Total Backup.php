<?php
	/*
	Plugin Name: Total Backup - By Fotan.net
	Plugin URI: http://www.fotan.net/custom-wordpress-plugins
	Description: Plugin for backing up your entire WordPress website, database and all. Pretty simple.  Hit the button and receive a link to download an archive file. Nothing is left on the server.
	Author: Matt Danskine - Fotan Web & Graphic Design
	Version: 1.0
	Author URI: http://www.fotan.net
	
	Copyright 2011  Matt Danskine - Fotan Web & Graphic Design  (email : matt@fotan.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

	*/

	add_action('admin_menu', 'fotan_menu');

	function fotan_menu() {
		add_menu_page('Total Backup', 'Total Backup', 'manage_options', 'total-backup-fotan', 'total_backup_fotan');
	}
	
	function total_backup_fotan() {
		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}
		
		// Code to do the backup and display the link
		echo '<div class="wrap">';
		
		// Heading and message
?>		
		<h1>Total Backup - By Fotan</h1>
        
<?php		
		
				global $wpdb;
				
				$upload_info = wp_upload_dir();								// Array of upload directory info
				$upload_dir = $upload_info['basedir'];						// base path to /uploads without trailing/
				$upload_url = $upload_info['baseurl'];						// url to /uploads without trailing/
				$content_url = content_url();
				$admin_url = admin_url();
				
				$blog_name = get_bloginfo('name');							// Blog Name (from general settings)
				$wp_version = get_bloginfo('version');						// Blog Version
				$timestamp = current_time('timestamp');						// Current time
			
			
				// Final file name should look something like... Blog Title - 10-15-2011 17:22:04 - WordPress v.3.2.1.tar.gz
				$backup_file_name = $blog_name ." - ". date("n-j-Y G:i:s",$timestamp) ." - WordPress v". $wp_version .".tar.gz";
				$backup_file = $upload_dir ."/". $backup_file_name;
				
				// TAR the blog folder
				// Start from the WordPress home folder, whatever that may be.  It's always 2 back from uploads.
				chdir($upload_dir);
				chdir("../../");
				exec("tar -czvf ". $upload_dir ."/files.tar.gz *");
				
				// Create a sql dump file
				chdir($upload_dir);
				exec("mysqldump -u".DB_USER." -p".DB_PASSWORD." ".DB_NAME." > db.sql");
				
				// Combine the wp files archive and sql dump
				exec("tar -czf ". escapeshellarg($backup_file) ." files.tar.gz db.sql");
		
				// Get rid of the original archive and sql file
				unlink("db.sql");
				unlink("files.tar.gz");
?>
                <p>&nbsp;</p>
                <p>Click on the icon to download your archive</p>
                <a href="<?php echo $upload_url ."/". $backup_file_name; ?>">
                <img name="Download Now Icon" src="<?php echo $content_url; ?>/plugins/total-archive-by-fotan/Download-icon.png" alt="Download Now Icon" border="0" />
				</a>
				<p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>Once you have completed downloading your archive file, you can delete it from the server here.<br />Highly recommended as server space is often limited.</p>
                <a href="<?php echo $content_url; ?>/plugins/total-archive-by-fotan/delete_archive.php?del=<?php echo $upload_dir ."/". $backup_file_name; ?>&ret=<?php echo $admin_url; ?>">
                <img name="Delete Now Icon" src="<?php echo $content_url; ?>/plugins/total-archive-by-fotan/Delete-icon.png" alt="Delete Now Icon" border="0" />
				</a>
<?php				
				
		
		
		echo '</div>';	
		// End Code
	}


	


?>