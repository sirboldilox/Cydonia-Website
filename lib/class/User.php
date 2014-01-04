<?php
/*
 * User.php
 * 
 * Copyright 2013 Matthew Parker <sirboldilox@hotmail.co.uk>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

namespace Auth;

class User
{
	private $username;
	private $displayname;
	private $admin;

	// Constructor
	public function __construct($Username,$Displayname,$Admin = false)
	{
		$this->username = Username;
		$this->displayname = Displayname;
		$this->admin = Admin;
	}

	// getMember functions 
	public function getUsername()
	{
		return $username;
	}
	
	public function getDisplayname()
	{
		return $displayname;
	}
	
	public function isAdmin()
	{
		return $admin;
	}

}
