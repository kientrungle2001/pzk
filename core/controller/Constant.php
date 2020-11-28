<?php

# attributes
define('ATTR_INDEX', 'index');
define('ATTR_NAME', 'name');
define('ATTR_TITLE', 'title');
define('ATTR_LABEL', 'label');
define('ATTR_TYPE', 'type');
define('ATTR_TABLE', 'table');
define('ATTR_LIKE', 'like');
define('ATTR_UPLOADTYPE', 'uploadtype');
define('ATTR_SHOW_VALUE', 'show_value');
define('ATTR_SHOW_NAME', 'show_name');
define('ATTR_CONDITION', 'condition');
define('ATTR_HREF', 'href');
define('ATTR_LINK', 'link');
define('ATTR_CTRL_LINK', 'ctrlLink');
define('ATTR_FIND_FIELD', 'findField');
define('ATTR_SHOW_FIELD', 'showField');
define('ATTR_IS_RAW', 'isRaw');
define('ATTR_FORMAT', 'format');
define('ATTR_ICON', 'icon');
define('ATTR_MAPS', 'maps');
define('ATTR_DELIMITER', 'delimiter');
define('ATTR_FIELDS', 'fields');
define('ATTR_MD_SIZE', 'mdsize');
define('ATTR_XS_SIZE', 'xssize');

define('ATTR_PARENT_FIELD', 'parentField');
define('ATTR_ADD_LABEL', 'addLabel');
define('ATTR_QUICK_MODE', 'quickMode');
define('ATTR_MODULE', 'module');
define('ATTR_LIST_FIELD_SETTINGS', 'listFieldSettings');
define('ATTR_SORT_FIELDS', 'sortFields');

## shorts
define('A_INDEX', ATTR_INDEX);
define('A_NAME', ATTR_NAME);
define('A_TITLE', ATTR_TITLE);
define('A_LABEL', ATTR_LABEL);
define('A_TYPE', ATTR_TYPE);
define('A_TABLE', ATTR_TABLE);
define('A_LIKE', ATTR_LIKE);
define('A_UPLOADTYPE', ATTR_UPLOADTYPE);
define('A_SHOW_VALUE', ATTR_SHOW_VALUE);
define('A_SHOW_NAME', ATTR_SHOW_NAME);
define('A_CONDITION', ATTR_CONDITION);
define('A_HREF', ATTR_HREF);
define('A_LINK', ATTR_LINK);
define('A_CTRL_LINK', ATTR_CTRL_LINK);
define('A_FIND_FIELD', ATTR_FIND_FIELD);
define('A_SHOW_FIELD', ATTR_SHOW_FIELD);
define('A_IS_RAW', ATTR_IS_RAW);
define('A_FORMAT', ATTR_FORMAT);
define('A_ICON', ATTR_ICON);
define('A_MAPS', ATTR_MAPS);
define('A_DELIMITER', ATTR_DELIMITER);
define('A_FIELDS', ATTR_FIELDS);
define('A_MD_SIZE', ATTR_MD_SIZE);
define('A_XS_SIZE', ATTR_XS_SIZE);

define('A_PARENT_FIELD', ATTR_PARENT_FIELD);
define('A_ADD_LABEL', ATTR_ADD_LABEL);
define('A_QUICK_MODE', ATTR_QUICK_MODE);
define('A_MODULE', ATTR_MODULE);
define('A_LIST_FIELD_SETTINGS', ATTR_LIST_FIELD_SETTINGS);
define('A_SORT_FIELDS', ATTR_SORT_FIELDS);

## tables
define('TABLE_DOCUMENT', 'document');
define('TABLE_CATEGORIES', 'categories');

## shorts

## table fields
# basic
define('FIELD_ID', 'id');
define('FIELD_TYPE', 'type');
define('FIELD_TITLE', 'title');
define('FIELD_NAME', 'name');
define('FIELD_CODE', 'code');
define('FIELD_ALIAS', 'alias');
define('FIELD_CATEGORY_ID', 'categoryId');
define('FIELD_CATEGORY_IDS', 'categoryIds');
define('FIELD_CATEGORY_NAME', 'categoryName');
define('FIELD_IMG', 'img');
define('FIELD_FILE', 'file');
define('FIELD_ORDERING', 'ordering');
define('FIELD_STATUS', 'status');
define('FIELD_TRIAL', 'trial');

define('FIELD_STATUS_TEXT', 'statusText');
define('FIELD_ORDERING_TEXT', 'orderingText');
define('FIELD_BRIEF_TEXT', 'briefText');

define('FIELDS_BASIC', [FIELD_TYPE, FIELD_TITLE, FIELD_ALIAS, FIELD_CATEGORY_ID, FIELD_IMG, FIELD_FILE, FIELD_ORDERING, FIELD_STATUS, FIELD_TRIAL]);

# education
define('FIELD_CLASSES', 'classes');

define('FIELD_SUBJECT_CATEGORY', 'subjectCategory');
define('FIELD_COURSE_ID', 'courseId');
define('FIELD_COURSE_TITLE', 'courseTitle');

# content
define('FIELD_BRIEF', 'brief');
define('FIELD_CONTENT', 'content');

# marketing
define('FIELD_META_KEYWORDS', 'meta_keywords');
define('FIELD_META_DESCRIPTION', 'meta_description');
define('FIELD_CAMPAIGN_ID', 'campaignId');

define('FIELDS_SEO', [FIELD_META_KEYWORDS, FIELD_META_DESCRIPTION]);

define('FIELD_LIKES', 'likes');
define('FIELD_VIEWS', 'views');
define('FIELD_COMMENTS', 'comments');
define('FIELD_IP', 'ip');
define('FIELD_VISITED', 'visited');

# creator
define('FIELD_CREATED', 'created');
define('FIELD_CREATOR_ID', 'creatorId');
define('FIELD_MODIFIED', 'modified');
define('FIELD_MODIFIED_ID', 'modifiedId');

define('FIELD_CREATOR_NAME', 'creatorName');
define('FIELD_MODIFIED_NAME', 'modifiedName');

# start & end
define('FIELD_START_DATE', 'startDate');
define('FIELD_END_DATE', 'endDate');

define('FIELDS_DATE', [FIELD_START_DATE, FIELD_END_DATE]);

# software & site
define('FIELD_GLOBAL', 'global');
define('FIELD_SOFTWARE', 'software');
define('FIELD_SITE', 'site');
define('FIELD_SHARED_SOFTWARES', 'sharedSoftwares');

define('FIELDS_SCOPE', [FIELD_GLOBAL, FIELD_SOFTWARE, FIELD_SITE, FIELD_SHARED_SOFTWARES]);

## shorts
# basic
define('F_ID', FIELD_ID);
define('F_TYPE', FIELD_TYPE);
define('F_TITLE', FIELD_TITLE);
define('F_NAME', FIELD_NAME);
define('F_CODE', FIELD_CODE);
define('F_ALIAS', FIELD_ALIAS);
define('F_CATEGORY_ID', FIELD_CATEGORY_ID);
define('F_CATEGORY_IDS', FIELD_CATEGORY_IDS);
define('F_CATEGORY_NAME', FIELD_CATEGORY_NAME);
define('F_IMG', FIELD_IMG);
define('F_FILE', FIELD_FILE);
define('F_ORDERING', FIELD_ORDERING);
define('F_STATUS', FIELD_STATUS);
define('F_TRIAL', FIELD_TRIAL);

define('F_STATUS_TEXT', FIELD_STATUS_TEXT);
define('F_ORDERING_TEXT', FIELD_ORDERING_TEXT);
define('F_BRIEF_TEXT', FIELD_BRIEF_TEXT);

define('F_BASIC', FIELDS_BASIC);

# education
define('F_CLASSES', FIELD_CLASSES);

define('F_SUBJECT_CATEGORY', FIELD_SUBJECT_CATEGORY);

define('F_COURSE_ID', FIELD_COURSE_ID);
define('F_COURSE_TITLE', FIELD_COURSE_TITLE);
# content
define('F_BRIEF', FIELD_BRIEF);
define('F_CONTENT', FIELD_CONTENT);

# marketing
define('F_META_KEYWORDS', FIELD_META_KEYWORDS);
define('F_META_DESCRIPTION', FIELD_META_DESCRIPTION);
define('F_CAMPAIGN_ID', FIELD_CAMPAIGN_ID);

define('F_SEO', FIELDS_SEO);

define('F_LIKES', FIELD_LIKES);
define('F_VIEWS', FIELD_VIEWS);
define('F_COMMENTS', FIELD_COMMENTS);
define('F_IP', FIELD_IP);
define('F_VISITED', FIELD_VISITED);

# creator
define('F_CREATED', FIELD_CREATED);
define('F_CREATOR_ID', FIELD_CREATOR_ID);
define('F_MODIFIED', FIELD_MODIFIED);
define('F_MODIFIED_ID', FIELD_MODIFIED_ID);

define('F_CREATOR_NAME', FIELD_CREATOR_NAME);
define('F_MODIFIED_NAME', FIELD_MODIFIED_NAME);

# start & end
define('F_START_DATE', FIELD_START_DATE);
define('F_END_DATE', FIELD_END_DATE);

define('F_DATE', FIELDS_DATE);

# software & site
define('F_GLOBAL', FIELD_GLOBAL);
define('F_SOFTWARE', FIELD_SOFTWARE);
define('F_SITE', FIELD_SITE);
define('F_SHARED_SOFTWARES', FIELD_SHARED_SOFTWARES);

define('F_SCOPE', FIELDS_SCOPE);

# db
define('C_AND', 'and');
define('C_OR', 'or');
define('C_EQUAL', 'equal');
define('C_LIKE', 'like');
define('C_GT', 'gt');
define('C_GTE', 'gte');
define('C_LT', 'lt');
define('C_LTE', 'lte');
define('C_IN', 'in');
define('C_COLUMN', 'column');

require_once __DIR__ . '/Constant/Join.php';
require_once __DIR__ . '/Constant/List.php';
require_once __DIR__ . '/Constant/Sort.php';
require_once __DIR__ . '/Constant/Edit.php';
require_once __DIR__ . '/Constant/Filter.php';
require_once __DIR__ . '/Constant/Parent.php';
require_once __DIR__ . '/Constant/Validator.php';
