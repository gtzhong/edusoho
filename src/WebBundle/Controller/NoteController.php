<?php

namespace WebBundle\Controller;

use Biz\Course\Service\CourseService;
use Biz\Note\Service\CourseNoteService;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\BaseController;

class NoteController extends BaseController
{
    public function saveNoteAction(Request $request, $courseId, $taskId)
    {
        $this->getCourseService()->tryTakeCourse($courseId);

        if ($request->isMethod('POST')) {
            $note           = $request->request->all();
            $note['status'] = isset($note['status']) && $note['status'] === 'on' ? 1 : 0;
            $note           = $this->getNoteService()->saveNote($note);
            return $this->createJsonResponse($note);
        }
    }

    /**
     * @return CourseNoteService
     */
    protected function getNoteService()
    {
        return $this->createService('Note:CourseNoteService');
    }

    /**
     * @return CourseService
     */
    protected function getCourseService()
    {
        return $this->createService('Course:CourseService');
    }
}