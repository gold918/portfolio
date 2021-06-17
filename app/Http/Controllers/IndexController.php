<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Site\HeroMain;
use App\Model\Site\About;
use App\Model\Site\Client;
use App\Model\Site\Feature;
use App\Model\Site\Service;
use App\Model\Site\Action;
use App\Model\Site\Count;
use App\Model\Site\Testimonial;
use App\Model\Site\Portfolio;
use App\Model\Site\Filter;
use App\Model\Site\Team;
use App\Model\Site\Map;
use App\Model\Site\Contact;
use Mail;
use App\Model\Site\SiteSocial;
use App\Model\Site\Subscriber;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Jobs\SendMailJob;

class IndexController extends Controller
{
    public function execute(Request $request)
    {
        if ($request->isMethod('POST')) {
            if (!empty($request->subscribe)) {
                try {
                    $validator = Validator::make($request->all(), [
                        'subscribe' => 'email|unique:subscribers,mail',
                    ]);
                    if ($validator->fails())
                    {
                        return response()->json($validator->errors()->all(), 500);
                    }
                    $subscribe = new Subscriber([
                        'mail' => $request->subscribe,
                    ]);
                    $subscribe->save();

                    return response()->json('Email успешно сохранен!');


                } catch (\Exception $e) {
                   return response()->json($e->getMessage(), 500);
                }
            } else {
                $data = $request->all();
                SendMailJob::dispatch($data)->onQueue('send_mail');
                return response('OK');
/*                Mail::send('mail.mail', ['data' => $data], function ($message) use ($data) {
                    $message->from($data['email']);
                    $message->to('test7689t@gmail.com')->subject($data['subject']);
                    echo 'OK';
                });*/
            }

        }
        if ($request->isMethod('GET')) {
            $hero = HeroMain::with('heroIconBoxes')->where('status', 1)
                                                            ->where('created_at', '<=', Carbon::now())
                                                            ->where('updated_at', '<=', Carbon::now())
                                                            ->get(['id', 'title', 'alias', 'text', 'background_image']);

            $about = About::with('aboutItems')->where('status', 1)
                                                      ->where('created_at', '<=', Carbon::now())
                                                      ->where('updated_at', '<=', Carbon::now())
                                                      ->get(['id', 'title', 'subtitle', 'text', 'image']);

            $clients = Client::where('status', 1)
                               ->where('created_at', '<=', Carbon::now())
                               ->where('updated_at', '<=', Carbon::now())
                               ->get(['name', 'logo']);

            $features = Feature::with('featureItems')->where('status', 1)
                                                             ->where('created_at', '<=', Carbon::now())
                                                             ->where('updated_at', '<=', Carbon::now())
                                                             ->get(['id', 'image']);

            $services = Service::where('status', 1)->where('status', 1)
                                                   ->where('created_at', '<=', Carbon::now())
                                                   ->where('updated_at', '<=', Carbon::now())
                                                   ->get(['title', 'alias', 'text', 'icon']);

            $action = Action::where('status', 1)->where('created_at', '<=', Carbon::now())
                                                ->where('updated_at', '<=', Carbon::now())
                                                ->first(['title', 'text', 'button_text', 'link', 'background_image',]);

            $counts = Count::with('countItems')->where('status', 1)
                                                       ->where('created_at', '<=', Carbon::now())
                                                       ->where('updated_at', '<=', Carbon::now())
                                                       ->get(['id', 'title', 'text', 'image']);

            $testimonials = Testimonial::with('testimonialItems')->where('status', 1)
                                                                         ->where('created_at', '<=', Carbon::now())
                                                                         ->where('updated_at', '<=', Carbon::now())
                                                                         ->first(['id', 'background_image']);

            $filters = Filter::where('status', 1)
                               ->where('created_at', '<=', Carbon::now())
                               ->where('updated_at', '<=', Carbon::now())
                               ->get(['name', 'alias']);

            $portfolio = Portfolio::with('filters')->where('status', 1)
                                                           ->where('created_at', '<=', Carbon::now())
                                                           ->where('updated_at', '<=', Carbon::now())
                                                           ->get(['id', 'name', 'alias', 'image', 'text', 'status']);

            $teamMembers = Team::with('teamSocials')->where('status', 1)
                                                            ->where('created_at', '<=', Carbon::now())
                                                            ->where('updated_at', '<=', Carbon::now())
                                                            ->get(['id', 'name', 'position', 'photo']);
            $map = Map::where('status', 1)
                        ->where('created_at', '<=', Carbon::now())
                        ->where('updated_at', '<=', Carbon::now())
                        ->first();

            $contacts = Contact::where('status', 1)
                                 ->where('created_at', '<=', Carbon::now())
                                 ->where('updated_at', '<=', Carbon::now())
                                 ->get(['title', 'value', 'icon']);
            $socials = SiteSocial::where('status', 1)
                                   ->where('created_at', '<=', Carbon::now())
                                   ->where('updated_at', '<=', Carbon::now())
                                   ->get(['name', 'icon', 'link']);

            $data = [
                'heroes' => $hero,
                'about' => $about,
                'clients' => $clients,
                'features' => $features,
                'services' => $services,
                'action' => $action,
                'counts' => $counts,
                'testimonials' => $testimonials,
                'filters' => $filters,
                'portfolio' => $portfolio,
                'teamMembers' => $teamMembers,
                'map' => $map,
                'contacts' => $contacts,
                'socials' => $socials,
            ];
            if (view()->exists('site.index')) {
                return view('site.index', $data);
            }
            abort(404);
        }
    }
}
