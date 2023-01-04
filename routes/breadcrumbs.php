<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('course', function ($trail) {
    $trail->push('Course', route('course.index'));
});

Breadcrumbs::for('curriculum', function ($trail, $id) {
    $trail->parent('course');
    $trail->push('curriculum', route('curriculum.view', $id));
});

Breadcrumbs::for('subject', function ($trail, $id) {
    $trail->parent('curriculum');
    $trail->push('subject', route('subject.selectsubject', $id));
});