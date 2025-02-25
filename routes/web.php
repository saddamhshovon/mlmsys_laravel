<?php

use App\Models\Member;
use App\Models\HomeGoal;
use App\Models\HomeAbout;
use App\Models\homestart;
use App\Models\HomeFooter;
use App\Models\RenewalFee;
use App\Models\ExpiryMonth;
use App\Models\HomeOurWork;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FundController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\GenerationController;
use App\Http\Controllers\RenewalFeeController;
use App\Http\Controllers\ExpiryMonthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MobileBankingController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\MembershipTypeController;
use App\Http\Controllers\DateRangeSearchController;

Route::get('/', function () {
    $homestart = homestart::first();
    $homeAbout = HomeAbout::first();
    $homeWork = HomeOurWork::first();
    $homeGoal = HomeGoal::first();
    $homeFooter = HomeFooter::first();
    return view('welcome', compact('homestart', 'homeAbout', 'homeWork', 'homeGoal', 'homeFooter'));
});


Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/auth', [AdminController::class, 'auth'])->name('admin.auth');

Route::get('/cities/where-country-is/{name}', [MemberController::class, 'cities'])->name('cities');

Route::get('/register', [MemberController::class, 'create'])->name('register');
Route::post('/register-member', [MemberController::class, 'store'])->name('register.member');

Route::get('/login', [MemberController::class, 'login'])->name('login');
Route::post('/login-member', [MemberController::class, 'auth'])->name('auth');


Route::get('/reset', [ForgotPasswordController::class, 'index'])->name('reset');
Route::post('/reset', [ForgotPasswordController::class, 'store'])->name('reset');
Route::get('/reset/{id}', [ForgotPasswordController::class, 'create'])->name('reset.pass');
Route::post('/reset-pass', [ForgotPasswordController::class, 'update'])->name('reset.pass.change');

/////////////              ADMIN ROUTE START                ///////////

Route::group(['middleware' => 'admin_auth'], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    ////////////         NOTIFICATION         ////////////

    Route::get('/admin/notification/all', [NotificationController::class, 'allNotification'])->name('all.notification');
    Route::get('/admin/notification/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notification.mark.read');
    Route::get('/admin/notification/new-member', [NotificationController::class, 'newMemberNotification'])->name('new.member.notification');
    Route::get('/admin/notification/withdraw-fund', [NotificationController::class, 'withdrawFundNotification'])->name('withdraw.fund.notification');
    Route::get('/admin/notification/add-fund-notification', [NotificationController::class, 'addFundNotification'])->name('add.fund.notification');
    Route::get('/admin/notification/read', [NotificationController::class, 'readNotification'])->name('read.notification');
    Route::get('/admin/notification/unread', [NotificationController::class, 'unreadNotification'])->name('unread.notification');

    //////////               Product Related Route Started            //////////

    Route::get('/admin/product/all', [ProductController::class, 'allProduct'])->name('product.all');
    Route::get('/admin/product/add', [ProductController::class, 'addProduct'])->name('product.add');
    Route::post('/admin/product/store', [ProductController::class, 'storeProduct'])->name('product.store');
    Route::get('/admin/product/edit/{id}', [ProductController::class, 'editProduct'])->name('product.edit');
    Route::post('/admin/product/update', [ProductController::class, 'updateProduct'])->name('product.update');
    Route::get('/admin/product/delete/{id}', [ProductController::class, 'deleteProduct'])->name('product.delete');
    Route::get('/admin/product/active/{id}', [ProductController::class, 'activeProduct'])->name('product.active');
    Route::get('/admin/product/inactive/{id}', [ProductController::class, 'inactiveProduct'])->name('product.inactive');
    Route::get('/admin/product/history', [ProductController::class, 'allProductOrderHistory'])->name('product.order.history');
    Route::get('/admin/product/approve/{id}', [ProductController::class, 'approveProductOrderHistory'])->name('product.order.approve');
    Route::get('/admin/product/delete-history/{id}', [ProductController::class, 'deleteProductOrderHistory'])->name('product.order.delete');

    //////////               Product Related Route Ended             //////////

    //////////               Admin Profile                ///////////////

    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admihn.profile');
    Route::post('/admin/profile-update', [AdminController::class, 'adminProfileUpdate'])->name('admin.profile.update');

    /////////////          Admin Profile Ended            /////////////

    //////////               User Manage Route Started             //////////

    Route::resource('/admin/member/all/daterange', DateRangeSearchController::class);
    Route::get('/admin/member/all/datesearch', [DateRangeSearchController::class, 'dateSearch'])->name('member.datesearch');

    Route::get('/admin/member/add', [AdminController::class, 'addMember'])->name('member.add');
    Route::post('/admin/member/add/register-member', [MemberController::class, 'storedByAdmin'])->name('admin.register.member');
    Route::get('/admin/member/all', [AdminController::class, 'allMember'])->name('member.all');
    Route::get('/admin/member/show/{id}', [AdminController::class, 'showMember'])->name('member.show');
    Route::get('/admin/member/edit/{id}', [AdminController::class, 'editMember'])->name('member.edit');
    Route::post('/admin/member/update/{id}', [AdminController::class, 'updateMember'])->name('member.update');
    Route::get('/admin/member/delete/{id}', [AdminController::class, 'deleteMember'])->name('member.delete');
    Route::get('/admin/member/active', [AdminController::class, 'activeMember'])->name('member.active');
    Route::get('/admin/member/inactive', [AdminController::class, 'inactiveMember'])->name('member.inactive');
    Route::get('/admin/member/blocked', [AdminController::class, 'blockedMember'])->name('member.blocked');
    Route::get('/admin/member/expired', [AdminController::class, 'expiredMember'])->name('member.expired');

    Route::get('/admin/member/is-active/{id}', [AdminController::class, 'isActive'])->name('member.is-active');
    Route::get('/admin/member/is-inactive/{id}', [AdminController::class, 'isInActive'])->name('member.is-inactive');
    Route::get('/admin/member/is-blocked/{id}', [AdminController::class, 'isBlocked'])->name('member.is-blocked');
    //////////               User Manage Route Ended             //////////


    //////////               Membership Process and Mobile Banking             //////////
    Route::get('/admin/membership-type', [MembershipTypeController::class, 'index'])->name('membership');
    Route::post('/admin/membership-type', [MembershipTypeController::class, 'store'])->name('membership');
    Route::post('/admin/membership-type-delete/{type}', [MembershipTypeController::class, 'delete'])->name('membership.delete');

    Route::get('/admin/mobile-banking', [MobileBankingController::class, 'index'])->name('mobile.banking');
    Route::post('/admin/mobile-banking', [MobileBankingController::class, 'store'])->name('mobile.banking');
    Route::post('/admin/mobile-banking-delete/{mobile}', [MobileBankingController::class, 'delete'])->name('mobile.banking.delete');
    //////////               Membership Process and Mobile Banking Ended             //////////



    /////////////              Fund Request Approval           ///////////
    Route::get('/admin/all-fund-add-request', [FundController::class, 'allFundAddRequestHistory'])->name('all.fund.request');
    Route::get('/admin/approve-fund-add-request-{id}', [FundController::class, 'apprveFundAddRequest'])->name('approve.fund.request');
    Route::get('/admin/reject-fund-add-request-{id}', [FundController::class, 'rejectFundAddRequest'])->name('reject.fund.request');
    Route::get('/admin/delete-fund-add-request-{id}', [FundController::class, 'deleteFundAddRequest'])->name('delete.fund.request');
    Route::get('/admin/all-transfer-fund-history', [FundController::class, 'allTransferFundHistory'])->name('all.transfer.fund.history');
    Route::get('/admin/all-withdraw-fund-history', [FundController::class, 'allWithdrawFundHistory'])->name('all.withdraw.fund.history');

    Route::get('/admin/approve-fund-withdraw-request-{id}', [FundController::class, 'apprveFundWithdrawRequest'])->name('approve.fund.withdraw.request');
    Route::get('/admin/reject-fund-withdraw-request-{id}', [FundController::class, 'rejectFundWithdrawRequest'])->name('reject.fund.withdraw.request');
    Route::get('/admin/delete-fund-withdraw-request-{id}', [FundController::class, 'deleteFundWithdrawRequest'])->name('delete.fund.withdraw.request');
    /////////////              Fund Request Approval Ended           ///////////

    //////////               Generation Route             //////////
    Route::get('/admin/hands', [AdminController::class, 'hands'])->name('hands');
    Route::post('/admin/hands-fix', [AdminController::class, 'handsFix'])->name('hands.fix');
    Route::post('/admin/hands-change', [AdminController::class, 'handsChange'])->name('hands.change');

    Route::get('/admin/generation', [GenerationController::class, 'index'])->name('generation');
    Route::post('/admin/generation-fix', [GenerationController::class, 'create'])->name('generation.fix');
    Route::get('/admin/generation-delete', [GenerationController::class, 'deleteLevels'])->name('generation.delete');

    Route::get('/admin/generation/income', [GenerationController::class, 'indexIncome'])->name('generation.income');
    Route::post('/admin/generation/income-save', [GenerationController::class, 'store'])->name('generation.incsave');
    Route::post('/admin/generation/income-update', [GenerationController::class, 'update'])->name('generation.incupdate');

    //////////                        Ranks Route                 //////////
    Route::get('/admin/ranks', [RankController::class, 'index'])->name('ranks');
    Route::post('/admin/ranks-fix', [RankController::class, 'create'])->name('ranks.fix');
    Route::get('/admin/ranks-delete', [RankController::class, 'deleteTotal'])->name('ranks.delete');

    Route::get('/admin/ranks/rank', [RankController::class, 'indexRank'])->name('ranks.rank');
    Route::post('/admin/ranks/rank-save', [RankController::class, 'store'])->name('ranks.save');
    Route::post('/admin/ranks/rank-update/{id}', [RankController::class, 'update'])->name('ranks.update');
    Route::get('/admin/ranks/rank-withdraw/{id}', [RankController::class, 'withdraw'])->name('ranks.withdraw');

    //////////                        Expiry Route                 //////////
    Route::get('/admin/expiry', [ExpiryMonthController::class, 'indexMonths'])->name('expiry.months');
    Route::post('/admin/expiry-fix', [ExpiryMonthController::class, 'createMonths'])->name('expiry.months.fix');
    Route::get('/admin/expiry-delete', [ExpiryMonthController::class, 'deleteMonths'])->name('expiry.months.delete');

    //////////                        Renewal fee Route                 //////////
    Route::get('/admin/expiry-renewal-fee', [RenewalFeeController::class, 'index'])->name('expiry.fee');
    Route::post('/admin/expiry-renewal-fee-fix', [RenewalFeeController::class, 'create'])->name('expiry.fee.fix');
    Route::get('/admin/expiry-renewal-fee-delete', [RenewalFeeController::class, 'delete'])->name('expiry.fee.delete');

    //////////                        Funds Route                 //////////
    Route::get('/admin/funds-tax', [FundController::class, 'fundsTax'])->name('funds.tax');
    Route::post('/admin/funds-tax-fix', [FundController::class, 'fundsTaxFix'])->name('funds.taxfix');
    Route::post('/admin/funds-tax-change', [FundController::class, 'fundsTaxChange'])->name('funds.taxchange');

    Route::get('/admin/withdraw-tax', [FundController::class, 'withdrawTax'])->name('withdraw.tax');
    Route::post('/admin/withdraw-tax-fix', [FundController::class, 'withdrawTaxFix'])->name('withdraw.taxfix');
    Route::post('/admin/withdraw-tax-change', [FundController::class, 'withdrawTaxChange'])->name('withdraw.taxchange');

    Route::get('/admin/withdraw-amount', [FundController::class, 'withdrawAmount'])->name('withdraw.amount');
    Route::post('/admin/withdraw-amount-fix', [FundController::class, 'withdrawAmountFix'])->name('withdraw.amountfix');
    Route::post('/admin/withdraw-amount-change', [FundController::class, 'withdrawAmountChange'])->name('withdraw.amountchange');

    Route::get('/admin/user-fund', [FundController::class, 'newUserFund'])->name('funds.reg');
    Route::post('/admin/user-fund-fix', [FundController::class, 'newUserFundFix'])->name('funds.regfix');
    Route::post('/admin/user-fund-change', [FundController::class, 'newUserFundChange'])->name('funds.regchange');

    Route::get('/admin/referral-income', [FundController::class, 'referralIncome'])->name('referreal.income');
    Route::post('/admin/referral-income-fix', [FundController::class, 'referralIncomeFix'])->name('referreal.incomefix');
    Route::post('/admin/referral-income-change', [FundController::class, 'referralIncomeChange'])->name('referreal.incomechange');
    Route::get('/admin/fund-add-to-user-view', [AdminController::class, 'addFundToUserView'])->name('admin.fund-add.view');
    Route::post('/admin/fund-add-to-user', [AdminController::class, 'addFundToUSer'])->name('admin.fund.add');

    //////////                        Notice                     //////////    

    Route::get('/admin/notice/dashboard', [AdminController::class, 'dashboardNotice'])->name('notice.dashboard');
    Route::get('/admin/notice/withdraw', [AdminController::class, 'withdrawNotice'])->name('notice.withdraw');
    Route::post('/admin/notice/dashboard-publish', [AdminController::class, 'dashboardNoticePublish'])->name('notice.dashboard.publish');
    Route::post('/admin/notice/withdraw-publish', [AdminController::class, 'withdrawNoticePublish'])->name('notice.withdraw.publish');

    //////////                        Notice End                     //////////

    //////////                        Support Message Start                     //////////

    Route::get('/admin/support-message/all', [SupportController::class, 'allSupportMessage'])->name('support.all.message');
    Route::get('/admin/support-message/show-{id}', [SupportController::class, 'showMessage'])->name('support.show.message');
    Route::post('/admin/support-message/reply-{id}', [SupportController::class, 'replyMessage'])->name('support.reply.message');

    //////////                        Support Message End                     //////////

    Route::get('/admin/leaderboard', [IncomeController::class, 'leaderBoardAdmin'])->name('admin.leaderboard');

    //////////                           HOME                  /////////////

    Route::get('/admin/home/start', [HomeController::class, 'homeStartSection'])->name('home.start');
    Route::get('/admin/home/about', [HomeController::class, 'homeAboutSection'])->name('home.about');
    Route::get('/admin/home/work', [HomeController::class, 'homeWorkSection'])->name('home.work');
    Route::get('/admin/home/goal', [HomeController::class, 'homeGoalSection'])->name('home.goal');
    Route::get('/admin/home/footer', [HomeController::class, 'homeFooterSection'])->name('home.footer');
    Route::get('/admin/home/notice', [HomeController::class, 'homeNoticeSection'])->name('home.notice');

    Route::post('/admin/home/start-submit', [HomeController::class, 'homeStartSubmit'])->name('home.start.submit');
    Route::post('/admin/home/about-submit', [HomeController::class, 'homeAboutSubmit'])->name('home.about.submit');
    Route::post('/admin/home/work-submit', [HomeController::class, 'homeWorkSubmit'])->name('home.work.submit');
    Route::post('/admin/home/goal-submit', [HomeController::class, 'homeGoalSubmit'])->name('home.goal.submit');
    Route::post('/admin/home/footer-submit', [HomeController::class, 'homeFooterSubmit'])->name('home.footer.submit');
    Route::post('/admin/home/notice-submit', [HomeController::class, 'homeNoticeSubmit'])->name('home.notice.submit');

    //////////                          HOME END                  /////////////

    Route::get('/admin/team/tree/{id}', [AdminController::class, 'teamTree'])->name('admin.team.tree');
});

/////////////              ADMIN ROUTE END                ///////////

/////////////              USER RELATED ROUTE START                ///////////

Route::group(['middleware' => 'member_auth'], function () {
    Route::get('/member', [MemberController::class, 'index'])->name('member.dashboard');
    Route::get('/logout', [MemberController::class, 'logout'])->name('member.logout');
    Route::get('/member/reupgrade', function(){
        $member = Member::where('id', session('MEMBER_ID'))->first();
        $fee = RenewalFee::first();
        $expiryMonths = ExpiryMonth::first();
        if($member->account_balance < $fee->fee){
            return back()->with('failed', 'You do not have sufficient balance');
        }
        $member->account_balance = $member->account_balance - $fee->fee;
        $member->is_expired = 0;
        $member->will_expire_on = now()->addMonth($expiryMonths->months);
        $member->save();

        return back()->with('failed', 'Succecfully upgraded');
    })->name('member.reupgrade');

    Route::get('/fund/transfer', [FundController::class, 'transferFund'])->name('fund.transfer');
    Route::post('/fund/transfer-request', [FundController::class, 'transferFundRequest'])->name('fund.transfer.request');

    Route::get('/fund/add', [FundController::class, 'addFundReq'])->name('fund.add');
    Route::post('/fund/add-request', [FundController::class, 'store'])->name('fund.addreq');

    Route::get('/fund/withdraw', [FundController::class, 'withdrawFund'])->name('fund.withdraw');
    Route::post('/fund/withdraw-request', [FundController::class, 'withdraw'])->name('fund.withdrawreq');

    Route::get('/team/tree/{id}', [MemberController::class, 'teamTree'])->name('team.tree');
    Route::get('/team/teams', [MemberController::class, 'teamTeams'])->name('team.teams');
    Route::post('/team/team-set/{id}', [TeamController::class, 'setTeam'])->name('team.set');
    Route::post('/team/team-change', [TeamController::class, 'changeTeam'])->name('team.change');
    Route::get('/member/leaderboard', [IncomeController::class, 'leaderBoard'])->name('member.leaderboard');

    ///////////////           USER PROFILE CHANGE         ////////////////

    Route::get('/profile/edit', [MemberController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [MemberController::class, 'updateProfile'])->name('profile.update');

    Route::get('/profile/change-password', [MemberController::class, 'changePassword'])->name('profile.change.password');
    Route::post('/profile/change-password-request', [MemberController::class, 'changePasswordRequest'])->name('profile.change.passwordRequ');

    Route::get('/profile/change-pin', [MemberController::class, 'changePin'])->name('profile.change.pin');
    Route::post('/profile/change-pin-request', [MemberController::class, 'changePinRequest'])->name('profile.change.pinRequ');

    Route::get('/profile/change-profile-picture', [MemberController::class, 'changeProfilePhoto'])->name('profile.change.photo');
    Route::post('/profile/change-profile-picture-request', [MemberController::class, 'changeProfilePhotoRequest'])->name('profile.change.photoRequ');

    ///////////////           END USER PROFILE CHANGE         ////////////////

    Route::get('/product/all', [ProductController::class, 'userAllProduct'])->name('product.all.user');
    Route::get('/product/buy/{name}-{id}', [ProductController::class, 'buyProduct'])->name('product.buy');
    Route::post('/product/order', [ProductController::class, 'orderProduct'])->name('product.order');
    Route::get('/history/product-order', [ProductController::class, 'memberProductOrderHistory'])->name('history.product.order');
    Route::get('/history/fund-add-request', [FundController::class, 'fundAddRequestHistory'])->name('history.fund.request');
    Route::get('/history/fund-transfer', [FundController::class, 'fundTransferHistory'])->name('history.fund.transfer');
    Route::get('/history/fund-withdraw-request', [FundController::class, 'fundWithdrawRequestHistory'])->name('history.withdraw.request');

    //////////////           Support Message                 //////////////////
    Route::get('/member/support-message', [SupportController::class, 'index'])->name('support.message.index');
    Route::post('/member/support-message-send', [SupportController::class, 'store'])->name('support.message.send');
    Route::get('/member/support-message-history', [SupportController::class, 'history'])->name('support.message.history');
});


/////////////              USER RELATED ROUTE END                ///////////

require __DIR__.'/manager/auth.php';
