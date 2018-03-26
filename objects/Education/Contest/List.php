<?php
pzk_import('Core.Db.List');
class PzkEducationContestList extends PzkCoreDbList {
	public $table = 'history_payment';
	public $joins = array(
		array(
			'table'		=>	'user',
			'condition'	=>	'history_payment.username	= user.username and history_payment.serviceType="contest"',
			'type'		=>	'inner'
		),
		array(
			'table'		=>	'contest',
			'condition'	=>	'history_payment.contestId	= contest.id',
			'type'		=>	'inner'
		)
	);
	public $fields = 'history_payment.*, user.name, user.phone, user.email, group_concat(contest.name) as tests';
	public $orderBy	= 	'history_payment.id desc';
	public $groupBy	=	'history_payment.username';
}