
<?php

/**
 * In PHPCR, you can lock nodes to prevent concurrency issues. There are two basic types of locks:
 * - Session based locks are only kept until your session ends and released automatically on logout.
 * - If a lock is not session based, it is identified by a lock token and stays in place until it times out
 * Note that Jackalope currently only implements session based locks:.
 *
 * @see http://phpcr.readthedocs.io/en/latest/book/locking.html
 */
require __DIR__.'/bootstrap.php';

//get the node from the session
$node = $session->getNode('/data/sibling');
//the node has to be lockable
$node->addMixin('mix:lockable');
$session->save(); //node needs to be clean before locking

// get the lock manager
$workspace = $session->getWorkspace();
$lockManager = $workspace->getLockManager();
dump($lockManager->isLocked('/data/sibling')); // should be false
$lockManager->lock('/data/sibling', true, true); // lock child nodes as well, release when session closed
// now only this session may change the node //sibling and its descendants
dump($lockManager->isLocked('/data/sibling')); // should be true
dump($lockManager->isLocked('/data/sibling/child1')); // should be true because we locked deep

// getting the lock from LockManager is not yet implemented with jackalope-jackrabbit
$lock = $lockManager->getLock('/data/sibling');
dump($lock->isLockOwningSession()); // true, this is our lock, not somebody else's
dump($lock->getSecondsRemaining()); // PHP_INT_MAX because this lock has no timeout
dump($lock->isLive()); // true

$node = $lock->getNode(); // this gets us the node for /sibling
$node === $lockManager->getLock('/data/sibling')->getNode(); // getnode always returns the lock owning node

// now unlock the node again
$lockManager->unlock('/data/sibling'); // we could also let $session->logout() unlock when using session based lock
dump($lockManager->isLocked('/data/sibling')); // false
dump($lock->isLive()); // false
