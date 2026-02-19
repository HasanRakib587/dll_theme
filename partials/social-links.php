<?php
    $author_id = 1; // Change to your main author ID
    $author = get_userdata($author_id);
    $class_to_add = get_query_var( 'class_to_add' );

    if ( ! empty( $class_to_add ) ) {
        $classes = '' . esc_attr( $class_to_add );
    } else {
        $classes = '';
    }
?>
<!-- facebook -->
<?php if (!empty($author->facebook)) : ?>
    <a class="<?php echo $classes; ?> text-decoration-none" href="<?php echo esc_url($author->facebook); ?>" target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95" />
        </svg>
    </a>
<?php endif; ?>
<!-- instagram -->
<?php if (!empty($author->instagram)) : ?>
    <a class="<?php echo $classes; ?> text-decoration-none" href="<?php echo esc_url($author->instagram); ?>" target="_blank"> 
        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
        <g fill="none">
            <path stroke="currentColor" stroke-width="2"
                d="M3 11c0-3.771 0-5.657 1.172-6.828S7.229 3 11 3h2c3.771 0 5.657 0 6.828 1.172S21 7.229 21 11v2c0 3.771 0 5.657-1.172 6.828S16.771 21 13 21h-2c-3.771 0-5.657 0-6.828-1.172S3 16.771 3 13z" />
            <circle cx="16.5" cy="7.5" r="1.5" fill="currentColor" />
            <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" />
        </g>
        </svg>
    </a>
<?php endif; ?>
<!-- twitter -->
<?php if (!empty($author->twitter)) : ?>
    <a class="<?php echo $classes; ?> text-decoration-none" href="<?php echo esc_url($author->twitter); ?>"
        target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M10.488 14.651L15.25 21h7l-7.858-10.478L20.93 3h-2.65l-5.117 5.886L8.75 3h-7l7.51 10.015L2.32 21h2.65zM16.25 19L5.75 5h2l10.5 14z" />
        </svg>
    </a>
<?php endif; ?>
<!-- pinterest -->
<?php if (!empty($author->pinterest)) : ?>
    <a class="<?php echo $classes; ?> text-decoration-none" href="<?php echo esc_url($author->pinterest); ?>" target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M9.04 21.54c.96.29 1.93.46 2.96.46a10 10 0 0 0 10-10A10 10 0 0 0 12 2A10 10 0 0 0 2 12c0 4.25 2.67 7.9 6.44 9.34c-.09-.78-.18-2.07 0-2.96l1.15-4.94s-.29-.58-.29-1.5c0-1.38.86-2.41 1.84-2.41c.86 0 1.26.63 1.26 1.44c0 .86-.57 2.09-.86 3.27c-.17.98.52 1.84 1.52 1.84c1.78 0 3.16-1.9 3.16-4.58c0-2.4-1.72-4.04-4.19-4.04c-2.82 0-4.48 2.1-4.48 4.31c0 .86.28 1.73.74 2.3c.09.06.09.14.06.29l-.29 1.09c0 .17-.11.23-.28.11c-1.28-.56-2.02-2.38-2.02-3.85c0-3.16 2.24-6.03 6.56-6.03c3.44 0 6.12 2.47 6.12 5.75c0 3.44-2.13 6.2-5.18 6.2c-.97 0-1.92-.52-2.26-1.13l-.67 2.37c-.23.86-.86 2.01-1.29 2.7z" />
        </svg>
    </a>
<?php endif; ?>
