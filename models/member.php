<?php

# == Schema Information ==
# Table name: member
#
#  id                 :integer         not null, primary key
#  name               :string(255)
#  email              :string(255)
#  created_at         :datetime
#  updated_at         :datetime
#  encrypted_password :string(255)
#  salt               :string(255)
#  remember_token     :string(255)
#  admin              :boolean
#

class member extends Model{
	static function test1(){return "USER KAKAKAKAKA CREATEd";}
}

?>
