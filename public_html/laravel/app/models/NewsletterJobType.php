<?php

class NewsletterJobType {

    public static function job_types() {

        return [
            '1' => 'オペレーター（受信）',
            '2' => 'オペレーター（発信）',
            '3' => 'オペレーター（発信/受発信）'
        ];

    }

    public static function job_type_names($ids, $key_flag = false) {

        $names = [];

        $job_types = NewsletterJobType::job_types();

        if(count($ids) > 0) {

            foreach ($ids as $key => $id) {

                if(isset($job_types[$id])) {

                    if($key_flag) {

                        $names[$id] = $job_types[$id];

                    } else {

                        $names[] = $job_types[$id];

                    }

                }

            }

        }

        return $names;

    }

}