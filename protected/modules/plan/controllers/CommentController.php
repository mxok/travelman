<?php
class CommentController extends Controller {
     public function filters() {
        
        return array(
            array(
                'application.filters.SessionCheckFilter'
            ) ,
        );
    }
    public function actionindex() {
        $comment = $this->initParams('PlanComment', 'new');
        if($comment->validate()){


        if ($comment->save()) {

        	$this->send(ERROR_NONE,'评论成功');
        };

        }
        else{

        	$this->error->capture($comment);
        }
        $this->render('index', array(
            'comment' => $comment
        ));
    }
}
