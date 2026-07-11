<?php
/**
 * Role-Based Access Control Configuration
 * Defines permissions and accessible pages for each role
 */

// Define role permissions and accessible pages
$ROLE_PERMISSIONS = [
    'admin' => [
        'label' => 'Administrator',
        'icon' => '⚙️',
        'pages' => [
            'dashboard' => [
                'label' => 'Dashboard',
                'icon' => '📊',
                'visible' => true,
                'accessible' => true
            ],
            'users' => [
                'label' => 'User Management',
                'icon' => '👥',
                'visible' => true,
                'accessible' => true
            ],
            'profile' => [
                'label' => 'My Profile',
                'icon' => '👤',
                'visible' => true,
                'accessible' => true
            ],
            'settings' => [
                'label' => 'Settings',
                'icon' => '⚙️',
                'visible' => true,
                'accessible' => true
            ]
        ]
    ],
    'teacher' => [
        'label' => 'Teacher',
        'icon' => '👨‍🏫',
        'pages' => [
            'dashboard' => [
                'label' => 'Dashboard',
                'icon' => '📊',
                'visible' => true,
                'accessible' => true
            ],
            'profile' => [
                'label' => 'My Profile',
                'icon' => '👤',
                'visible' => true,
                'accessible' => true
            ],
            'classes' => [
                'label' => 'My Classes',
                'icon' => '📚',
                'visible' => true,
                'accessible' => true
            ],
            'grades' => [
                'label' => 'Grade Management',
                'icon' => '📝',
                'visible' => true,
                'accessible' => true
            ],
            'settings' => [
                'label' => 'Settings',
                'icon' => '⚙️',
                'visible' => true,
                'accessible' => true
            ]
        ]
    ],
    'student' => [
        'label' => 'Student',
        'icon' => '👨‍🎓',
        'pages' => [
            'dashboard' => [
                'label' => 'Dashboard',
                'icon' => '📊',
                'visible' => true,
                'accessible' => true
            ],
            'grades' => [
                'label' => 'My Grades',
                'icon' => '📝',
                'visible' => true,
                'accessible' => true
            ],
            'attendance' => [
                'label' => 'Attendance',
                'icon' => '✓',
                'visible' => true,
                'accessible' => true
            ],
            'profile' => [
                'label' => 'My Profile',
                'icon' => '👤',
                'visible' => true,
                'accessible' => true
            ],
            'settings' => [
                'label' => 'Settings',
                'icon' => '⚙️',
                'visible' => true,
                'accessible' => true
            ]
        ]
    ]
];

/**
 * Check if a user with a given role can access a specific page
 * 
 * @param string $role User's role
 * @param string $page Page to access
 * @return bool True if accessible, false otherwise
 */
function canAccessPage($role, $page) {
    global $ROLE_PERMISSIONS;
    
    if (!isset($ROLE_PERMISSIONS[$role])) {
        return false;
    }
    
    if (!isset($ROLE_PERMISSIONS[$role]['pages'][$page])) {
        return false;
    }
    
    return $ROLE_PERMISSIONS[$role]['pages'][$page]['accessible'];
}

/**
 * Get visible pages for a specific role
 * 
 * @param string $role User's role
 * @return array Array of visible pages
 */
function getVisiblePages($role) {
    global $ROLE_PERMISSIONS;
    
    if (!isset($ROLE_PERMISSIONS[$role])) {
        return [];
    }
    
    $visiblePages = [];
    foreach ($ROLE_PERMISSIONS[$role]['pages'] as $pageKey => $pageData) {
        if ($pageData['visible']) {
            $visiblePages[$pageKey] = $pageData;
        }
    }
    
    return $visiblePages;
}

/**
 * Get page label and icon for navigation
 * 
 * @param string $role User's role
 * @param string $page Page name
 * @return array Array with 'label' and 'icon' keys
 */
function getPageInfo($role, $page) {
    global $ROLE_PERMISSIONS;
    
    if (isset($ROLE_PERMISSIONS[$role]['pages'][$page])) {
        return [
            'label' => $ROLE_PERMISSIONS[$role]['pages'][$page]['label'],
            'icon' => $ROLE_PERMISSIONS[$role]['pages'][$page]['icon']
        ];
    }
    
    return [
        'label' => ucfirst($page),
        'icon' => '📄'
    ];
}

/**
 * Get role label
 * 
 * @param string $role User's role
 * @return string Role label
 */
function getRoleLabel($role) {
    global $ROLE_PERMISSIONS;
    
    return $ROLE_PERMISSIONS[$role]['label'] ?? ucfirst($role);
}

?>