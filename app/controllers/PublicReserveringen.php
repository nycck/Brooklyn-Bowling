class PublicReserveringen extends BaseController
{
    private $reserveringModel;

    public function __construct()
    {
        $this->reserveringModel = $this->model('Reservering');
    }

    public function index()
    {
        $data = [
            'naam' => '',
            'email' => '',
            'baanId' => '',
            'starttijd' => '',
            'eindtijd' => '',
            'aantalVolwassenen' => '',
            'aantalKinderen' => '',
            'error' => ''
        ];

        $this->view('public_reserveringen/index', $data);
    }

    public function reserve()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'naam' => trim($_POST['naam']),
                'email' => trim($_POST['email']),
                'baanId' => trim($_POST['baanId']),
                'starttijd' => trim($_POST['starttijd']),
                'eindtijd' => trim($_POST['eindtijd']),
                'aantalVolwassenen' => trim($_POST['aantalVolwassenen']),
                'aantalKinderen' => trim($_POST['aantalKinderen']),
                'error' => ''
            ];

            if (empty($data['naam']) || empty($data['email']) || empty($data['baanId']) || empty($data['starttijd']) || empty($data['eindtijd'])) {
                $data['error'] = 'Vul alle velden in.';
            }

            if (empty($data['error'])) {
                if ($this->reserveringModel->addPublicReservering($data)) {
                    header('Location: ' . URLROOT . '/public_reserveringen/success');
                } else {
                    $data['error'] = 'Er is een fout opgetreden.';
                }
            }

            $this->view('public_reserveringen/index', $data);
        }
    }

    public function success()
    {
        $this->view('public_reserveringen/success');
    }
}
