<?php
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition:attachment;Filename=Mateja_Mastelica_73_20.doc");
$word = "<table>
            <thead>
                <tr>
                    <th><b>Mateja Mastelica</b> 73/20</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> 
                    My name is Mateja Mastelica 73/20. I was born in Belgrade, where I finished primary and secondary school.I started working and getting interested in entrepreneurship, and as in every beginning 'I was looking for myself', and then for the first time I came in contact with programming and the web, so after a year I decided to enroll in Higher ICT school, exclusively for Web Programming, because my area of interest is Web technology and digital marketing in E-commerce. I enjoy making websites and I am very enthuastic of my profession. I'm learning new things every day, and i do my best to maximize my knowledge about Web development,marketing and SEO. I work with passion and I'm always trying to make a friendly relationship with my clients.
                    </td>
                </tr>
            </tbody>
        </table>";
echo $word;