<?php

namespace Database\Seeders;

use App\Enums\TeamGroup;
use App\Models\TeamMember;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TeamMemberSeeder extends Seeder
{
    /**
     * Source: company profile pp. 20-24. No portraits are supplied, so none are seeded.
     * Name-to-designation pairing on p.20 and the affiliate qualifications on p.21
     * (listed in a separate column) need client confirmation.
     */
    public function run(): void
    {
        $core = [
            ['Arc. Oriaku Hanson Oyet-Ile', 'MD/CEO', 'M.Sc (Arch.), FNIA, FSM, ACIArb', self::MD_BIO, true],
            ['Arc. Ebiwene O. Bozimo', 'Architect', 'M.Sc (Arch.), FNIA, PMP', self::BOZIMO_BIO, true],
            ['Arc. Peter Honest Dateme', 'Project Manager', 'PMP, FNIA, CFPM, Intl. Asso. AIA', self::DATEME_BIO, true],
            ['Albert Michael Tamunoibuomi', 'Architect', 'M.Sc (Arch.)', null, false],
            ['Onyeanyi Uchenna Cosmas', 'Structural Engineer', 'M.Sc Civil Engr, MNSE', null, false],
            ['Aderemi Ogunsakin John', 'Electrical Engineer', 'MTech, MNSE', null, false],
            ['Noble Nnabugwu', 'Civil Engineer', 'HND Civil Eng.', null, false],
            ['Egwuonwu Obinna Goodnews', 'Quantity Surveyor', 'B.Sc (QS), NIQS', null, false],
        ];

        foreach ($core as $i => [$name, $designation, $quals, $bio, $featured]) {
            $this->member($name, $designation, $quals, $bio, TeamGroup::Core, null, $i, $featured,
                'NEEDS CONFIRMATION: designation pairing from p.20; Bozimo is "Project Manager" in his p.23 heading and Dateme is described as a chartered healthcare architect in his biography.');
        }

        $affiliates = [
            'Architects' => ['Arc. H. A. Akin Akiyode', 'Arc. Moesi J. Otsemobor'],
            'Structural Engineers' => ['Engr. Okike Kalu Okike'],
            'MEP Engineers' => ['Engr. Victor Adediran', 'Engr. Salihu Makanju Musa', 'Engr. Osaghale Abbot'],
            'Land Surveyors' => ['Sur. Nwokedi Ifeanyi Nwokedi'],
            'Quantity Surveyors' => ['Naomi Landue'],
        ];

        $order = 100;
        foreach ($affiliates as $category => $names) {
            foreach ($names as $name) {
                $this->member($name, null, null, null, TeamGroup::Affiliate, $category, $order++, false,
                    'NEEDS CONFIRMATION: qualifications are listed in a separate column on p.21 and are not matched to names.');
            }
        }
    }

    private function member(string $name, ?string $designation, ?string $quals, ?string $bio, TeamGroup $group, ?string $category, int $order, bool $featured, string $note): void
    {
        TeamMember::firstOrCreate(['slug' => Str::slug($name)], [
            'name' => $name,
            'designation' => $designation,
            'qualifications' => $quals,
            'biography' => $bio,
            'group' => $group,
            'professional_category' => $category,
            'is_featured' => $featured,
            'sort_order' => $order,
            'admin_notes' => $note,
            'published_at' => now(),
        ]);
    }

    private const MD_BIO = "Started as a lecturer in the Department of Architecture, Rivers State University of Science and Technology, Nkpolu, Port Harcourt, Rivers State. She later moved to LACOSTER Nigeria Limited Port Harcourt where she was in-charge of Project Coordination. She had also worked with KNOX Associates, Port Harcourt, where she was responsible for Conceptual Design, Preliminary Design/working drawings, Coordination of working drawings, Routine site inspection, and post contract project supervision. She founded the firm, Custom Realities, in 1992. Currently, she is the Chief Executive Officer of Custom Realities Limited. She holds a Master of Science (M.Sc) Degree in Architecture from University of Nigeria, Nsukka. She is a fellow of the Nigerian Institute of Architects (FNIA), a fellow of the Institute of Strategic Management (FSM), and a Fellow of the Mentoring and Career Development Institute of Nigeria (FMCDI). She is a member of the Project Management Institute (PMI), an Associate member of the Chartered Institute of Arbitration, UK (ACIArb), and an International member of the National Association of Home Builders (NAHB). She formerly served as Rivers State Coordinator, NACCIMA Business Women's Group (NAWORG). Currently, she serves as the Rivers State Coordinator, Association of Nigerian Women Business Network (ANWBN). She also has Advanced Leadership Training from the Haggai International.";

    private const BOZIMO_BIO = "Arc. Ebiwene O. Bozimo is a motivated and innovative architect, certified project manager and IFC EDGE Expert with 30+ years of international success spearheading complex and high-visibility design, development, construction, and infrastructure projects in a range of industries, including residential, commercial, industrial, retail, hospitality, healthcare, institutional, mixed-use, and transportation.\n\nHe is a visionary project planner with big-picture strategies and meticulous attention to detail. Technical proficiency in Revit, AutoCAD, Sketchup, 3D Studio Max, Viz, Adobe Premiere, Microsoft Project, Microsoft Office applications, CorelDraw, Photopaint and Publisher. He utilizes opportunities to contribute strategy and solutions in architecture, project-management and development roles.\n\nHis areas of expertise and technical skills are not limited to the following: Architecture, Project Planning, International Building Codes, Contract Administration, Inspection/Safety, Procurement, Building Information Modeling, Computer-Aided Design, Rendering/Animation, Stakeholder Communication, Client Relations, Health, Safety, and Environment, Sustainability, Budgeting/Economics, Entrepreneurism, Presentation/Speaking, Construction Management, and Graphic Design.";

    private const DATEME_BIO = "Arc. Peter Honest Dateme is a Project Management Professional and chartered healthcare architect. He had his education in the University of Jos, and Cornell University, with a major in Healthcare Facility Design and Planning.\n\nArc. Dateme has several years' experience developing, implementing and managing various projects within time, scope and cost constraints. He held a Vice President leadership role in the Project Management Institute (PMI) and an executive position in the NIA Rivers State Chapter for 12 years. He is the Vice Chairman of the Chartered Institute of Project Managers of Nigeria's Resourcery Team and a Trauma Healing Facilitator.\n\nHe is also a: Fellow of the Chartered Institute of Project Managers of Nigeria (CIPMN); Fellow of the Nigerian Institute of Architects (NIA); Secretary, Research Team of PMI Africa; Member, Academy of Neuroscience for Architecture; Editor, American Society of Industrial Security (ASIS); International Associate of the American Institute of Architects (AIA).\n\nHe is an international speaker, coach, mentor, an advocate of Salutogenesis and passionate about making Project Management indispensable for business results.";
}
